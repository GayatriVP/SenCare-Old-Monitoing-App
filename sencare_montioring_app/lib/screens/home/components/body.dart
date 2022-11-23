import 'package:flutter/material.dart';
import 'package:sencare_montioring_app/constants.dart';
import 'package:sencare_montioring_app/screens/home/components/title_with_btn.dart';
import 'package:sencare_montioring_app/screens/home/components/videofeed.dart';
import '../../../components/search_box.dart';

class Body extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Container(
      child: SafeArea(
        child: Column(
          children: <Widget>[
            SearchBox(),
            SizedBox(height: kDefaultpadding / 2),
            TitleWithMore(title: "Monitors", press: (){},),
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
                              children: [
                                VideoFeed(),
                                VideoFeed(),
                              ],
                            ),
                            Column(
                              children: [
                                VideoFeed(),
                                VideoFeed(),
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
