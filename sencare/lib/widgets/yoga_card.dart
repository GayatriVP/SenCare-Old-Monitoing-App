import 'package:flutter/material.dart';
import 'package:sencare/constant.dart';

class YogaCard extends StatelessWidget {
  final String imgsrc;
  final String yoganame;
  final VoidCallback? press;

  const YogaCard({
    super.key, 
    required this.imgsrc, 
    required this.yoganame, 
    required this.press,
  });

  @override
  Widget build(BuildContext context) {
    return ClipRRect(
      borderRadius: BorderRadius.circular(12),
      child: Container(
        margin: const EdgeInsets.symmetric(vertical: 8.0),
        // padding: const EdgeInsets.all(12),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(12),
          boxShadow: const [kDefaultshadow],
        ),
        child: Material(
          color: Colors.transparent,
          child: InkWell(
            onTap: press,
            child: Padding(
              padding: const EdgeInsets.all(8.0),
              child: Column(
                children: <Widget>[
                  const Spacer(),
                  Image.asset(
                    imgsrc, 
                    height: 160, 
                    // color: Color.fromARGB(255, 79, 175, 223),
                    ),
                  const Spacer(),
                  Text(
                    yoganame,
                    textAlign: TextAlign.center,
                    style: const TextStyle(
                      fontSize: 22,
                      fontWeight: FontWeight.w400,
                    ),
                    )
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}