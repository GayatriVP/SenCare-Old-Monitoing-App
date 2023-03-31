import 'package:flutter/material.dart';
import 'package:sencare/constant.dart';
import 'package:sencare/screens/camera.dart';
import 'package:sencare/widgets/instruction_card.dart';

class YogaInstructions3 extends StatelessWidget {
  const YogaInstructions3({super.key});

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
                image: AssetImage("images/yoga/goddess1.png"),
                fit: BoxFit.contain,
                alignment: Alignment.topRight
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
                    "2 set- Hold for 5-10 deep breaths",
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
                      "Opens the hips and chest while strengthening and toning the lower body & stimulates the uro-genital, respiratory and cardiovascular systems.",
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
                                data: 'Begin in a standing position with feet shoulder width apart , toes turned out and arms reaching straight up overhead.',
                                ),
                                // Spacer(),
                                InstructionCard(size: size, 
                                num: '2',
                                data: 'Bend your knees to a 90 degree angle and pull your elbows slightly inward to shoulder height.  Keep hands open.',
                                ),
                                InstructionCard(size: size, 
                                num: '3',
                                data: 'Make sure your posture is tall and straight, as if you slid your back down along a wall. Keep abs tight.',
                                ),
                                InstructionCard(size: size, 
                                num: '4',
                                data: 'Hold and breathe for 30 seconds as you continue to open knees outward and lower your shoulder blades down.',
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
