class Yoga{
  final String num ;
  final String title, description, image;

  Yoga({required this.num, required this.title, required this.description, required this.image});
}

// list of Yogas
// for our demo
List<Yoga> Yogas = [
  Yoga(
    num: '1',
    title: "Butterfly Pose",
    image: "images/yoga/butterfly.png",
    description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incnumnumunt ut labore et dolore magna aliqua. Ut enim ad minim",
  ),
  Yoga(
    num: '2',
    title: "Goddess Pose",
    image: "images/yoga/goddess0.jpg",
    description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incnumnumunt ut labore et dolore magna aliqua. Ut enim ad minim",
  ),
  Yoga(
    num: '3',
    title: "Tree Pose",
    image: "images/yoga/tree.jpg",
    description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incnumnumunt ut labore et dolore magna aliqua. Ut enim ad minim",
  ),
  Yoga(
    num: '4',
    title: "Warrior Pose",
    image: "images/yoga/warrior0.jpg",
    description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incnumnumunt ut labore et dolore magna aliqua. Ut enim ad minim",
  ),
  
];