export class User {

  id: number;
  username: String;
  email: String;
  firstname: String;
  name: String;
  birthday: String;
  gender: String;
  street: String;
  postalCode: number;
  city: String;
  isPremium: boolean;


  constructor(
  id: number,
  username: String,
  email: String,
  firstname: String,
  name: String,
  birthday: String,
  gender: String,
  street: String,
  postalCode: number,
  city: String,
  isPremium: boolean)
  {
    this.id = id;
    this.username = username;
    this.email = email;
    this.firstname = firstname;
    this.name = name;
    this.birthday = birthday;
    this.gender = gender;
    this.street = street;
    this.postalCode = postalCode;
    this.city = city;
    this.isPremium = isPremium;
  }

  /*constructor(user: User){
    this.id = user.id;
    this.username = user.username;
    this.email = user.email;
    this.firstname = user.firstname;
    this.name = user.name;
    this.birthday = user.birthday;
    this.gender = user.gender;
    this.street = user.street;
    this.postalCode = user.postalCode;
    this.city = user.city;
    this.isPremium = user.isPremium;
  }*/

}

