import 'package:flutter/material.dart';
import 'package:sencare/constant.dart';
import 'package:sencare/screens/camera.dart';
import 'package:sencare/widgets/instruction_card.dart';

class YogaInstructions1 extends StatelessWidget {
  const YogaInstructions1({super.key});

  @override
  Widget build(BuildContext context) {
    var size = MediaQuery.of(context).size;
    return Scaffold(
      appBar: AppBar(
            backgroundColor: kBlueLightColor, 
            elevation: 0.0,
            leading: IconButton(
              color: Colors.white,
               onPressed: (){
                 Navigator.pop(context);
               },
               icon:const Icon(Icons.arrow_back_ios), 
               //replace with our own icon data.
            )
          ),
      body: Stack(
        children: <Widget>[
          Container(
            // alignment: Alignment.centerRight,
            height: size.height*0.45,
            decoration: const BoxDecoration(
              color: kBlueLightColor,
              image: DecorationImage(
                image: AssetImage("images/yoga/butterfly.png"),
                fit: BoxFit.contain,
                alignment: Alignment.centerRight
                ),
            ),
          ),
          SafeArea(
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  SizedBox(
                    height: size.height*0.05,
                  ),
                  const Text("Butterfly Pose",
                    style: TextStyle(
                      fontWeight: FontWeight.w400, 
                      fontSize: 30,
                      color: Colors.white,
                      ),
                  ),
                  const SizedBox(height: 10,),
                  const Text(
                    "2 to 3 set- 30s each",
                    style: TextStyle(
                      fontWeight:FontWeight.w400,
                      fontSize: 15,
                      color: Colors.white,
                    ),
                  ),
                  const SizedBox(height: 10,),
                  SizedBox(
                    width: size.width *0.4,
                    child: const Text(
                      "Stretch for your inner thighs, hip flexors, outer thighs, and entire hip complex along with lower back extensors",
                      style: TextStyle(
                        fontWeight:FontWeight.w400,
                        fontSize: 13,
                        color: Colors.white,
                      ),
                    ),
                  ),
                  const SizedBox(height: 20,),
                  // SizedBox(
                  //   height: 55,
                  //   child: Container(
                  //     padding: EdgeInsets.only(top: 18),
                  //     width: size.width*0.2,
                  //     decoration: BoxDecoration(
                  //       borderRadius:BorderRadius.circular(10),
                  //       color: Color.fromRGBO(238, 94, 159, 1),
                  //       ),
                  //     child: Text(
                  //       "Start",
                  //       style: TextStyle(fontSize: 18, fontWeight: FontWeight.w500, color: Colors.white),
                  //       textAlign: TextAlign.center,
                  //     ),
                  //   ),
                  // ),
                  SizedBox(
                    height: 60,
                    child: Container(
                      margin: EdgeInsets.only(top: 15),
                      // color: Color.fromRGBO(238, 94, 159, 1),
                      width: size.width*0.27,
                      decoration: BoxDecoration(
                        color: Color.fromRGBO(238, 94, 159, 1),
                        borderRadius: BorderRadius.circular(10),
                        boxShadow: [kDefaultshadow]
                        ),
                      child: TextButton(
                        onPressed: () {
                          Navigator.push(context, MaterialPageRoute(builder: (context){
                            return const CameraPage();
                          }),);
                        },
                        child: const Text(
                          "Start",
                          style: TextStyle(fontSize: 18, fontWeight: FontWeight.w500, color: Colors.white),
                          textAlign: TextAlign.center,
                        ),
                      ),
                    ),
                  ),
                  const SizedBox(height: 50),
                  Expanded(
                    child: Container(
                      width: size.width,
                      // decoration: BoxDecoration(
                      //   color: Colors.white
                      // ),
                      child: Center(
                        child: SingleChildScrollView(
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            // crossAxisAlignment: CrossAxisAlignment.center,
                            
                            // spacing: 30,
                            // runSpacing: 20,
                            
                              children: <Widget>[
                                InstructionCard(size: size, 
                                num: '1',
                                data: 'Come to a seated position and bring the soles of your feet together. Keep your spine tall and abs pulled in tight.',
                                ),
                                // Spacer(),
                                InstructionCard(size: size, 
                                num: '2',
                                data: 'Grab hold of each foot with your hands and place elbows against your inner thighs.',
                                ),
                                InstructionCard(size: size, 
                                num: '3',
                                data: 'Keeping your spine long, inhale to prepare, and as you exhale, slowing lower your torso forward pausing when you feel the stretch.',
                                ),
                                InstructionCard(size: size, 
                                num: '4',
                                data: 'Hold on for 30 seconds or more. Repeat.',
                                ),
                                // SizedBox(height: 20,),
                              ],
                            ),
                        ),
                      ),
                    ),
                  ),
                  
                ],
              ),
            )
          )
        ],
      ),
    );
  }
}
