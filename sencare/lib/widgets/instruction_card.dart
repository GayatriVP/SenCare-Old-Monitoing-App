
import 'package:flutter/material.dart';
import 'package:sencare/constant.dart';

class InstructionCard extends StatelessWidget {
  final String num;
  final String data;

  const InstructionCard({
    super.key,
    required this.size, required this.num, required this.data,
  });

  final Size size;

  @override
  Widget build(BuildContext context) {
    return Container(
      height: 100,
      width: size.width*0.95,
      // padding: EdgeInsets.all(16.0),
      margin: EdgeInsets.symmetric(vertical: 15, ),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(15),
        boxShadow: [kDefaultshadow]
      ),
      child: Row(
        children: <Widget>[
          Container(
            height: 30,
            width: 35,
            // decoration: BoxDecoration(
            //   color: Color.fromRGBO(146,193,255, 1),
            //   shape: BoxShape.rectangle,
            //   borderRadius: BorderRadius.circular(10)
            // ),
            child: Padding(
              padding: EdgeInsets.only(top:8.5),
              child: Text(
                num,
                style: TextStyle(color: Colors.black, fontSize: 18),
                textAlign: TextAlign.center,
              ),
            ),
          ),
          SizedBox(width: 10,),
          Container(
            width: size.width*0.75,
            child: Text(
              data,
              style: TextStyle(
                fontWeight:FontWeight.w400,
                fontSize: 15,
              ),
              textAlign: TextAlign.start,
            ),
          )
        ],
      ),
    );
  }
}