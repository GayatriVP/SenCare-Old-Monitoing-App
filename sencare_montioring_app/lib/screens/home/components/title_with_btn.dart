import 'package:flutter/material.dart';
import 'package:sencare_montioring_app/constants.dart';

class TitleWithMore extends StatelessWidget {
  const TitleWithMore({
    Key? key,
    required this.title,
    required this.press,
  }) : super(key: key);

  final String title;
  final VoidCallback press;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: kDefaultpadding),
      child: Row(
        children: [
          CustomTitle(text: title),
          Spacer(),
          ElevatedButton(
            child: Text(
              "More",
              style: TextStyle(color: kPrimarycolor, fontSize: 20.0),
            ),
            onPressed: press,
          )
        ],
      ),
    );
  }
}

class CustomTitle extends StatelessWidget {
  const CustomTitle({
    Key? key,
    required this.text,
  }) : super(key: key);

  final String text;
  @override
  Widget build(BuildContext context) {
    return Container(
      height: 24.0,
      child: Stack(
        children: <Widget>[
          Padding(
            padding: const EdgeInsets.only(left: kDefaultpadding / 4),
            child: Text(
              text,
              style: TextStyle(
                  fontSize: 20.0,
                  decoration: TextDecoration.none,
                  fontWeight: FontWeight.bold,
                  color: Colors.white),
            ),
          ),
          Positioned(
            child: Container(
              margin: EdgeInsets.only(right: kDefaultpadding / 4),
              height: 10.0,
              color: kPrimarycolor.withOpacity(0.2),
            ),
          ),
        ],
      ),
    );
  }
}
