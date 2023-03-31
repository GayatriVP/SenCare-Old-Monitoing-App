import 'package:curved_navigation_bar/curved_navigation_bar.dart';
import 'package:flutter/material.dart';
import 'package:sencare/body.dart';
import 'package:sencare/screens/reminders.dart';
import 'package:sencare/screens/yoga_instructions1.dart';
import 'package:sencare/widgets/bottom_navbar.dart';

class HomePage extends StatefulWidget {
  const HomePage({Key? key}) : super(key: key);
  
  
  @override
  _NavState createState() => _NavState();
  // Widget build(BuildContext context) {
    
  //   var size = MediaQuery.of(context).size;
    
  //   final screens= <Widget>[
  //     Body(size: size),
  //     Body(size: size),
  //     Body(size: size),
  //     YogaInstructions1(),
  //     // Album(),
  //     // Body(size: size),
  //     // Reminders(),
  //     // Profile(),
  //     ];
  //   final items = <Widget>[
  //     Icon(Icons.photo_outlined, size: 35),
  //     Icon(Icons.fitness_center, size: 35, ),
  //     Icon(Icons.assignment_outlined, size: 35),
  //     Icon(Icons.account_circle_rounded, size: 35),
  //   ];

    // return SafeArea(
    //   top: false,
    //   child: Scaffold(
    //     // bottomNavigationBar: BottomNavBar(),
    //   bottomNavigationBar: Theme(
    //     data:  Theme.of(context).copyWith(
    //       iconTheme: IconThemeData(
    //         color: Colors.white
    //       )
    //     ),
    //     child: CurvedNavigationBar(
    //     color: Color.fromARGB(255, 218, 130, 57),
    //     backgroundColor: Colors.transparent,
    //     height: 67.0,
    //     animationCurve: Curves.easeInOut,
    //     animationDuration: Duration(milliseconds: 300),
    //     items: items,
    //     index: index,
    //     onTap: (index){

    //     },
    //     ),
    //   ),
    //     body: screens[index],
    //   ),
    // );
  // }
}

class _NavState extends State<HomePage> {
  
  final items = <Widget>[
      Icon(Icons.photo_outlined, size: 35),
      Icon(Icons.fitness_center, size: 35, ),
      Icon(Icons.assignment_outlined, size: 35),
      Icon(Icons.account_circle_rounded, size: 35),
    ];
  int index =0;

  

  @override
  Widget build(BuildContext context) {
    var size = MediaQuery.of(context).size;
    final navigationKey= GlobalKey<CurvedNavigationBarState>();

    // final screens= <Widget>[
    //   Body(size: size),
    //   Body(size: size),
    //   ReminderPage(),
    //   Body(size: size),
    //   // Album(),
    //   // Body(size: size),
    //   // Reminders(),
    //   // Profile(),
    //   ];

    return SafeArea(
      top: false,
      child: Scaffold(
        extendBody: true,
        bottomNavigationBar: Theme(
          data:  Theme.of(context).copyWith(
          iconTheme: IconThemeData(
            color: Colors.white
          )
        ),
          child: CurvedNavigationBar(
            items: items,
            index: index,
            color: Color.fromARGB(255, 218, 130, 57),
            onTap: (selctedIndex){
              setState(() {
                index = selctedIndex;
              });
            },
            // height: 60,
            height: 67.0,
            animationCurve: Curves.easeInOut,
            backgroundColor: Colors.transparent,
            animationDuration: const Duration(milliseconds: 300),
            // animationCurve: ,
          ),
        ),
        body: getSelectedWidget(index: index, size: size),
      ),
    );
  }

  Widget getSelectedWidget({required int index, required var size}){
    Widget widget;

    switch(index){
      case 0:
        var size = MediaQuery.of(context).size;
        widget = Body(size: size,);
        break;
      case 1:
        var size = MediaQuery.of(context).size;
        widget = Body(size: size,);
        break;
      case 2:
        widget = const ReminderPage();
        break;
      case 3:
        widget = const ReminderPage();
        break;
      default:
        var size = MediaQuery.of(context).size;
        widget = Body(size: size,);
        break;
    }
    return widget;
  }
}
