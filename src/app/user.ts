export class User {

 private id: number;
 private username: String;
  private email: String;
  private firstname: String;
  private name: String;
  private birthday: Date;
  private gender: String;
  private street: String;
  private houseNumber: number;
  private postcode: number;
  private city: String;
  private isPremium: boolean;
  private picture: String;

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
