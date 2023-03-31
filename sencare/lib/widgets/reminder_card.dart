
import 'package:flutter/material.dart';

import '../constant.dart';

class ReminderCard extends StatelessWidget {
  final String taskName;
  final bool taskCompleted;
  Function(bool?)? onChanged;

  ReminderCard({
    super.key, 
    required this.taskName, 
    required this.taskCompleted,
    required this.onChanged
    });


  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: EdgeInsets.all(12),
      child: Container(
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(12),
          boxShadow: const [kDefaultshadow],
        ),
        padding: EdgeInsets.symmetric(vertical: 23, horizontal: 18 ),
        child: Row(
          children: [
            Checkbox(value: taskCompleted, onChanged: onChanged),
            SizedBox(width: 10,),
            Text(
              taskName,
              style: TextStyle(decoration: taskCompleted? TextDecoration.lineThrough: TextDecoration.none),
            ),
          ],
        ),
      ),
    );
  }
}