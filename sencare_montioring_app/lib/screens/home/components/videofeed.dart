import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart';
import 'package:sencare_montioring_app/constants.dart';
import 'package:video_player/video_player.dart';
import 'package:video_player_web/video_player_web.dart';
import 'package:sencare_montioring_app/screens/home/components/api.dart';
import 'dart:io';
import 'package:http/http.dart' as http;
import 'package:path/path.dart';
import 'package:async/async.dart';
// import 'package:flutter_video_player_demo/video_items.dart';

class VideoFeed extends StatefulWidget {
  final url;

  const VideoFeed({Key? key, this.url}) : super(key: key);

  @override
  _VideoPlayerScreenState createState() => _VideoPlayerScreenState(this.url);
}

class _VideoPlayerScreenState extends State<VideoFeed> {
  late final _url;

  _VideoPlayerScreenState(this._url);

  late VideoPlayerController _controller;
  late Future<void> _initializeVideoPlayerFuture;
  late Future<String> _calculation;

  @override
  void initState() {
    super.initState();
    _calculation = Future<String>.delayed(
      const Duration(seconds: 120),
      () => AppData().Getdata('http://192.168.0.169:5000/'),
    );

    _controller = VideoPlayerController.asset(this._url);
//     _controller.initialize().then((value) {
//     _controller.play();
//     _controller.setLooping(true);
// });
    _initializeVideoPlayerFuture = _controller.initialize();
  }

  @override
  void dispose() {
    _controller.dispose();

    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.symmetric(
        horizontal: kDefaultpadding,
        vertical: kDefaultpadding / 2,
      ),
      // color: Colors.blueAccent,
      height: 300,
      width: 600,
      child: Stack(
        alignment: Alignment.bottomCenter,
        children: <Widget>[
          Visibility(
              visible: true,
              child: FutureBuilder<String>(
                  future:
                      _calculation, // a previously-obtained Future<String> or null
                  builder:
                      (BuildContext context, AsyncSnapshot<String> snapshot) {
                    if (!snapshot.hasData)
                      return Container(); // This container can be a loading screen, since its waiting for data.
                    if (snapshot.data!.isNotEmpty) {
                      print('detected');
                      return Text("Alert");
                    } else {
                      print("List Null");
                      return Text("");
                    }
                  })),
          Container(
            height: 200,
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(20),
              color: kSecondarycolor,
              boxShadow: const [kDefaultshadow],
            ),
            child: Container(
              margin: const EdgeInsets.only(right: 10),
              decoration: BoxDecoration(
                  color: Colors.white, borderRadius: BorderRadius.circular(20)),
            ),
          ),
          Positioned(
              child: Container(
            padding: const EdgeInsets.symmetric(horizontal: kDefaultpadding),
            height: 200,
            width: 460,
            child: FutureBuilder<dynamic>(
              future: _initializeVideoPlayerFuture,
              builder: (context, snapshot) {
                if (snapshot.connectionState == ConnectionState.done) {
                  // If the VideoPlayerController has finished initialization, use
                  // the data it provides to limit the aspect ratio of the video.
                  _controller.play();
                  _controller.setLooping(true);

                  return AspectRatio(
                    aspectRatio: _controller.value.aspectRatio,
                    // Use the VideoPlayer widget to display the video.
                    child: VideoPlayer(_controller),
                  );
                } else {
                  // If the VideoPlayerController is still initializing, show a
                  // loading spinner.
                  return const Center(
                    child: CircularProgressIndicator(),
                  );
                }
              },
            ),

            // child: FutureBuilder(
            //   future: _initializeVideoPlayerFuture,
            //   builder: (context, snapshot) {
            //     if (snapshot.connectionState == ConnectionState.done) {
            //       // If the VideoPlayerController has finished initialization, use
            //       // the data it provides to limit the aspect ratio of the video.
            //       _controller.play();
            //       _controller.setLooping(true);
            //       return AspectRatio(
            //         aspectRatio: _controller.value.aspectRatio,
            //         // Use the VideoPlayer widget to display the video.
            //         child: VideoPlayer(_controller),
            //       );
            //     } else {
            //       // If the VideoPlayerController is still initializing, show a
            //       // loading spinner.
            //       return const Center(
            //         child: CircularProgressIndicator(),
            //       );
            //     }
            //   },
            // ),
          )),
          Visibility(
            visible: false,
            child: FloatingActionButton(
              onPressed: () {
                setState(() {
                  //pause
                  if (_controller.value.isPlaying) {
                    _controller.pause();
                  } else {
                    // play
                    _controller.play();
                  }
                });
              },
              child: Icon(
                _controller.value.isPlaying ? Icons.pause : Icons.play_arrow,
              ),
            ),
          )
        ],
      ),
    );
  }
}

// class VideoPlayerScreen extends StatefulWidget {
//   VideoPlayerScreen({Key? key}) : super(key: key);

//   @override
//   _VideoPlayerScreenState createState() => _VideoPlayerScreenState();
// }

// class _VideoPlayerScreenState extends State<VideoPlayerScreen> {
//   late VideoPlayerController _controller;
//   late Future<void> _initializeVideoPlayerFuture;

//   @override
//   void initState() {
//     _controller = VideoPlayerController.network(
//       'https://drive.google.com/file/d/19LuyaSz4eDg6I0XdPd_AuPSuLGk7Yt3-/view?usp=share_link',
//     );

//     _initializeVideoPlayerFuture = _controller.initialize();

//     super.initState();
//   }

//   @override
//   void dispose() {
//     _controller.dispose();

//     super.dispose();
//   }

//   @override
//   Widget build(BuildContext context) {
//     return Row(
//       children: [
//         FutureBuilder(
//           future: _initializeVideoPlayerFuture,
//           builder: (context, snapshot) {
//             if (snapshot.connectionState == ConnectionState.done) {
//               return AspectRatio(
//                 aspectRatio: _controller.value.aspectRatio,
//                 child: VideoPlayer(_controller),
//               );
//             } else {
//               return Center(child: CircularProgressIndicator());
//             }
//           },
//         ),
        // FloatingActionButton(
        //   onPressed: () {
        //     setState(() {
        //       //pause
        //       if (_controller.value.isPlaying) {
        //         _controller.pause();
        //       } else {
        //         // play
        //         _controller.play();
        //       }
        //     });
        //   },
        //   child: Icon(
        //     _controller.value.isPlaying ? Icons.pause : Icons.play_arrow,
        //   ),
        // )
//       ],
//     );
//   }
// }
