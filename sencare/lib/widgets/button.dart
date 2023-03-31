import 'package:flutter/material.dart';

class myButton extends StatelessWidget {
  final String text;
  late VoidCallback onPressed;

  myButton({super.key, required this.text, required this.onPressed});

  @override
  Widget build(BuildContext context) {
    return MaterialButton(
      onPressed: onPressed,
      color: Color.fromRGBO(238, 94, 159, 1),
      padding: EdgeInsets.symmetric(vertical: 20, horizontal: 15),
      child: Text(
        text,
        style: TextStyle(color: Colors.white, fontSize: 15),
        ),
    );
  }
}