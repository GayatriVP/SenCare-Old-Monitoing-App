import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:sencare/body.dart';
import 'package:sencare/constant.dart';
import 'package:sencare/homepage.dart';

class BottomNavBar extends StatelessWidget {
  const BottomNavBar({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    
  var size = MediaQuery.of(context).size;
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 40, vertical: 10),
      height: 75,
      color: const Color.fromARGB(255, 229, 192, 117),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: <Widget>[
          BottomNavItem(svgSrc: "assets/icons/home.svg", title: "Home", press: () {
            Navigator.push(context, MaterialPageRoute(builder: (context){
              return HomePage();
            }));
          }),
          BottomNavItem(svgSrc: "assets/icons/dumbell.svg", title: "Yoga", press: () {
            Navigator.push(context, MaterialPageRoute(builder: (context){
              return Body(size: size,);
            }));
          }),
          BottomNavItem(svgSrc: "assets/icons/calendar.svg", title: "Reminders", press: () {
            Navigator.push(context, MaterialPageRoute(builder: (context){
              return HomePage();
            }));
          })
        ],
      ),
    );
  }
}

class BottomNavItem extends StatelessWidget {
  final String svgSrc;
  final String title;
  final VoidCallback? press;
  final bool isActive;

  const BottomNavItem({
    super.key, required this.svgSrc, required this.title, required this.press, this.isActive=false,
  });

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: press,
      child: Column(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: <Widget>[
          SvgPicture.asset(svgSrc, height: 25, width: 25,color: isActive ?kActiveIconColor : kTextColor,),
          Text(title, style: TextStyle(color: isActive ?kActiveIconColor : kTextColor),),
          
        ],
      ),
    );
  }
}
