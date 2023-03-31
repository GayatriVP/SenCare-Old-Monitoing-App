import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:sencare/screens/yoga_instructions1.dart';
import 'package:sencare/screens/yoga_instructions2.dart';
import 'package:sencare/screens/yoga_instructions3.dart';
import 'package:sencare/screens/yoga_instructions4.dart';
import 'package:sencare/widgets/yoga_card.dart';

class Body extends StatelessWidget {
  const Body({
    super.key,
    required this.size,
  });

  final Size size;

  @override
  Widget build(BuildContext context) {
    return Stack(children: <Widget>[
      Container(
        height: size.height*0.45,
        decoration: const BoxDecoration(
          color: Color.fromARGB(255, 229, 192, 117),
          ),
        ),
        SafeArea(
          child: Padding(
            padding: const EdgeInsets.symmetric(horizontal:20),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: <Widget>[
                Align(
                  alignment: Alignment.topRight,
                  child: Container(
                    margin: const EdgeInsets.only(top: 12, right: 7),
                    // padding: const EdgeInsets.symmetric(horizontal:20),
                    alignment: Alignment.center,
                    height: 52,
                    width: 52,
                    decoration: const BoxDecoration(
                      color: Color.fromARGB(255, 205, 166, 87),
                      shape: BoxShape.circle,
                    ),
                    child: SvgPicture.asset('icons/emergency-call-_1_.svg', height: 30, width: 30, fit: BoxFit.contain, color: Color.fromARGB(255, 193, 45, 45),)
                  ),
                ),
                Container(
                  margin: const EdgeInsets.only(top: 20, bottom: 20),
                  child: const Text(
                    '"Aging is not lost youth but a new stage of opportunity and strength."',
                    style: TextStyle(fontWeight: FontWeight.w500, fontSize: 25),
                  ),
                ),
                Expanded(
                  child: GridView.count(
                    crossAxisCount: 2, 
                    childAspectRatio: 0.85,
                    crossAxisSpacing: 20,
                    mainAxisSpacing: 20,
                    children: [
                      YogaCard(
                        imgsrc: 'images/yoga/butterfly.png', 
                        yoganame: 'Butterfly Pose', 
                        press: () {
                          Navigator.push(context, MaterialPageRoute(builder: (context){
                            return const YogaInstructions1();
                          }),);
                        },
                        ),
                      YogaCard(
                        imgsrc: 'images/yoga/goddess1.png', 
                        yoganame: 'Goddess Pose', 
                        press: () {
                          Navigator.push(context, MaterialPageRoute(builder: (context){
                            return const YogaInstructions3();
                          }),);
                        },
                        ),
                      YogaCard(
                        imgsrc: 'images/yoga/tree.png', 
                        yoganame: 'Tree Pose', 
                        press: () {
                          Navigator.push(context, MaterialPageRoute(builder: (context){
                            return const YogaInstructions2();
                          }),);
                        },
                        ),
                      YogaCard(
                        imgsrc: 'images/yoga/warrior0.png', 
                        yoganame: 'Warrior Pose', 
                        press: () {
                          Navigator.push(context, MaterialPageRoute(builder: (context){
                            return const YogaInstructions4();
                          }),);
                        },
                        )
                    ],))
              ],
          
            ),
          ),
        )
      ]
    );
  }
}
