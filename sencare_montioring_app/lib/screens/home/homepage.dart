import 'package:flutter/material.dart';
import 'package:sencare_montioring_app/constants.dart';
import 'components/body.dart';
import 'package:flutter_svg/flutter_svg.dart';

class HomePage extends StatelessWidget {
  const HomePage({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: kPrimarycolor,
      appBar: navBar(),
      body: Body(),
    );
  }
}

AppBar navBar() {
  return AppBar(
    elevation: 0,
    title: Text('Dashboard'),
    titleTextStyle: TextStyle(
      fontSize: 25,
      fontWeight: FontWeight.lerp(FontWeight.w800, FontWeight.w900, 7.5),
      color: Colors.white,
    ),
    centerTitle: false,
    backgroundColor: kPrimarycolor,
    actions: <Widget>[
      IconButton(
        icon: SvgPicture.asset(
          "assets/icons/notification.svg",
          color: Colors.white,
        ),
        onPressed: () {},
      )
    ],
    leading: IconButton(
      icon: SvgPicture.asset(
        "assets/icons/menu.svg",
        color: Colors.white,
        height: 30.0,
        width: 30.0,
      ),
      tooltip: 'Menu Icon',
      onPressed: () {},
    ),
  );
}
