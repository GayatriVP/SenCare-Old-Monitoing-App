import 'package:flutter/material.dart';

const kPrimarycolor = Color.fromARGB(255, 100, 130, 210);
const kSecondarycolor = Color.fromARGB(255, 65, 100, 200);
const textColor = Color.fromRGBO(255, 255, 255, 1.0);
const kDefaultpadding = 20.0;
const kDefaultshadow = BoxShadow(
  offset: Offset(0, 15),
  blurRadius: 27,
  color: Color.fromRGBO(0, 0, 0, 0.12)
);

// class SizeConfig {
//   static MediaQueryData? _mediaQueryData;
//   static double? screenWidth;
//   static double? screenHeight;
//   static double? defaultSize;
//   static Orientation? orientation;

//   void init(BuildContext context) {
//     _mediaQueryData = MediaQuery.of(context);
//     screenWidth = _mediaQueryData!.size.width;
//     screenHeight = _mediaQueryData!.size.height;
//     orientation = _mediaQueryData!.orientation;

//     defaultSize = orientation == Orientation.landscape
//         ? screenHeight! * 0.024
//         : screenWidth! * 0.024;
//   }
// }
