// import 'dart:html';

import 'package:flutter/material.dart';
import 'package:sencare_montioring_app/constants.dart';
import 'package:sencare_montioring_app/screens/home/components/api.dart';
import 'package:sencare_montioring_app/screens/home/components/title_with_btn.dart';
import 'package:sencare_montioring_app/screens/home/components/videofeed.dart';
import '../../../components/search_box.dart';
import 'dart:io';
import 'package:http/http.dart' as http;
import 'package:path/path.dart';
import 'package:async/async.dart';

class Body extends StatelessWidget {
  late File vid1;
  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Container(
      child: SafeArea(
        child: Column(
          children: <Widget>[
            SearchBox(),
            SizedBox(height: kDefaultpadding / 2),
            TitleWithMore(
              title: "Monitors",
              press: () {},
            ),
            SizedBox(height: kDefaultpadding / 2),
            Expanded(
              child: Stack(
                children: <Widget>[
                  Container(
                    margin: EdgeInsets.only(top: 70),
                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.only(
                        topLeft: Radius.circular(40),
                        topRight: Radius.circular(40),
                      ),
                    ),
                  ),
                  Container(
                    child: ListView(
                      children: [
                        Row(
                          children: [
                            Column(
                              children: <Widget>[
                                VideoFeed(url: 'videos/fall-01.mp4'),
                                VideoFeed(url: 'videos/fall-04.mp4'),
                                
                                // Extra(new File('videos/fall-01.mp4'))
                                //     .uploadImageToServer(),
                              ],
                            ),
                            Column(
                              children: [
                                VideoFeed(url: 'videos/fall-05.mp4'),
                                VideoFeed(url: 'videos/fall-06.mp4'),
                              ],
                            ),
                            
                          ],
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

// class Extra extends StatelessWidget {
//   late File vid1;

//   Extra(File file) {
//     vid1 = file;
//   }
//   uploadImageToServer() async {
//     var stream = new http.ByteStream(DelegatingStream.typed(vid1.openRead()));
//     var length = await vid1.length();
//     print(length);

//     var uri = Uri.parse('http://192.168.1.103:5000/predict');
//     print("connection established.");
//     var request = new http.MultipartRequest("POST", uri);
//     var multipartFile = new http.MultipartFile('file', stream, length,
//         filename: basename(vid1.path));
//     //contentType: new MediaType('image', 'png'));

//     request.files.add(multipartFile);
//     var response = await request.send();
//     print(response.statusCode);
//   }

//   @override
//   Widget build(BuildContext context) {
//     // TODO: implement build
//     throw UnimplementedError();
//   }
// }
