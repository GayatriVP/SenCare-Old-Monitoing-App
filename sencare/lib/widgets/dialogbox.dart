import 'package:flutter/material.dart';
import 'package:sencare/widgets/button.dart';

class DialoBox extends StatelessWidget {
  const DialoBox({super.key});

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      backgroundColor: Colors.white,
      content: Container(
        height: 120,
        child: Column(
          children: [
            SizedBox(height: 10,),
            TextField(
              decoration: InputDecoration(
                border: UnderlineInputBorder(),
                hintText: 'Add a reminder',
              ),
            ),
            SizedBox(height: 20,),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                myButton(
                text: 'Save',
                onPressed: () {  },),
                myButton(
                text: 'Cancel',
                onPressed: () {  },)
              ]
              
            )
          ],
        ),
      ),

    );
  }
}