import 'package:flutter/material.dart';
import 'package:sencare_montioring_app/constants.dart';
import 'package:sencare_montioring_app/screens/home/homepage.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'SenCare App',
      theme: ThemeData(
        primaryColor: kPrimarycolor,
        accentColor: kPrimarycolor,
        visualDensity: VisualDensity.adaptivePlatformDensity,
      ),
      home: HomePage(),
    );
  }
}