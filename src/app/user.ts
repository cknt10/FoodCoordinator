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

constructor(user: User){
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
  return this.postalCode;
}
getCity(){
  return this.city;
}
getIsPremum(){
  return this.isPremium;
}

}

