export class User {

  id: number;
  username: String;
  email: String;
  firstname: String;
  name: String;
  birthday: String;
  gender: String;
  street: String;

  constructor(
  id: number,
  username: String,
  email: String,
  firstname: String,
  name: String,
  birthday: String,
  gender: String,
  street: String)
  {
    this.id = id;
    this.username = username;
    this.email = email;
    this.firstname = firstname;
    this.name = name;
    this.birthday = birthday;
    this.gender = gender;
    this.street = street;
  }

}

