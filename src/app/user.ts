export class User {

  id: number;
  username: String;
  email: String;
  firstname: String;
  name: String;
  birthday: Date;
  gender: String;
  street: String;
  houseNumber: number;
  postcode: number;
  city: String;
  isPremium: boolean;
  picture: String;

constructor(user: User){
  this.id = user.id;
  this.username = user.username;
  this.email = user.email;
  this.firstname = user.firstname;
  this.name = user.name;
  this.birthday = user.birthday;
  this.gender = user.gender;
  this.street = user.street;
  this.postcode = user.postcode;
  this.city = user.city;
  this.isPremium = user.isPremium;
  this.picture = user.picture;
}

getId(){
  return this.id;
}
getUsername(){
  return this.username;
}
getEmail(){
  return this.email;
}
getFirstname(){
  return this.firstname;
}
getName(){
  return this.name;
}
getBirthday(){
  return this.birthday;
}
getGender(){
  return this.gender;
}
getStreet(){
  return this.street;
}
getPostalcode(){
  return this.postcode;
}
getCity(){
  return this.city;
}
getIsPremum(){
  return this.isPremium;
}
getPicture(){
  return this.picture;
}
getHouseNumber(){
  return this.houseNumber;
}

//////////////////////////////////////clean User Object//////////////////////////////////
cleanUser(){
  this.id = null;
  this.username = "";
  this.email = "";
  this.firstname = "";
  this.name = "";
  this.birthday = null;
  this.houseNumber = null;
  this.gender = "";
  this.street = "";
  this.postcode = null;
  this.city = "";
  this.isPremium = false;
}

}
