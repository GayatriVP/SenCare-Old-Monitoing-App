import 'package:flutter/material.dart';
import 'package:sencare/homepage.dart';
import 'package:sencare/widgets/dialogbox.dart';
import 'package:sencare/widgets/reminder_card.dart';

class ReminderPage extends StatefulWidget {
  const ReminderPage({super.key});

  @override
  State<ReminderPage> createState() => _ReminderPageState();
}

class _ReminderPageState extends State<ReminderPage> {

  List reminderList = [
    ['8.00 AM- Exercise Time', false],
    ['10.00 PM- Snacks Time', false],
    ['3.00 PM- Take Medicine', false],
    ['7.00 PM- Yoga Time', false],
  ];

  void checkBoxChanged(bool? value, int index){
    setState(() {
      reminderList[index][1] = !reminderList[index][1];
    });
  }

  void createNewTask(){
    showDialog(context: context, builder: (context){
      return DialoBox();
    });
  }

  @override
  Widget build(BuildContext context) {
    // var size = MediaQuery.of(context).size;
    return Scaffold(
      
      appBar: AppBar(
        toolbarHeight: 70.0,
        backgroundColor: Color.fromARGB(255, 229, 192, 117),
        title: Text(
          'Reminders',
          style: TextStyle(color: Colors.white),
          textAlign: TextAlign.center,),
          elevation: 0,
          leading: IconButton(
              color: Colors.white,
               onPressed: (){
                Navigator.push(context, MaterialPageRoute(builder: (context){
                  return HomePage();
                }));
               },
               icon:const Icon(Icons.arrow_back_ios), 
               //replace with our own icon data.
            )
      ),

      floatingActionButton: FloatingActionButton(
        // elevation: 0,
        backgroundColor: Color.fromRGBO(238, 94, 159, 1),
        onPressed: createNewTask,
        child: Icon(Icons.add, size: 30,),
        ),
      floatingActionButtonLocation: FloatingActionButtonLocation.miniCenterTop,

      body: Container(
        margin: EdgeInsets.only(top: 35),
        child: ListView.builder(
          itemCount: reminderList.length,
          itemBuilder: (context, index){
            return ReminderCard(taskName: reminderList[index][0],
             taskCompleted: reminderList[index][1], 
             onChanged: (value)=> checkBoxChanged(value, index),
             );
          },
          // children: [
          //   ReminderCard(
          //     taskName: '10.00 AM- Take yor medicine',
          //     taskCompleted: true,
          //     onChanged: ((p0) {
                
          //     }),
          //   ),
          //   ReminderCard(
          //     taskName: '4.00 PM- Take yor medicine',
          //     taskCompleted: true,
          //     onChanged: ((p0) {
                
          //     }),
          //   ),
          //   ReminderCard(
          //     taskName: '5.30 PM- Snacks time',
          //     taskCompleted: false,
          //     onChanged: ((p0) {
                
          //     }),
          //   ),
          //   ReminderCard(
          //     taskName: '8.00 PM- Meal time',
          //     taskCompleted: true,
          //     onChanged: ((p0) {
                
          //     }),
          //   ),
          // ],
        ),
      ),
    );
  }
}

