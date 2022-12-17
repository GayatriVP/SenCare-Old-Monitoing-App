import 'dart:convert';

import 'package:http/http.dart' as http;

class AppData {
  static final AppData _appData = new AppData._internal();

  Future<String> Getdata(url) async {
    http.Response Response = await http.get(url);

    return jsonDecode(Response.body)['return'];
  }

  factory AppData() {
    return _appData;
  }
  AppData._internal();
}

final appData = AppData();
