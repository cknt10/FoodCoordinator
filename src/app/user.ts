import { Premium } from './premium';

export class User{
  private id: number;
  private username: String;
  private email: String;
  private firstname: String;
  private name: String;
  private birthday: Date;
  private gender: String;
  private street: String;
  private houseNumber: String;
  private postalCode: number;
  private city: String;
  private isPremium: boolean;
  private picture: String;
  private premiumUser: Premium;

  constructor(user: User, premium?: Premium) {
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
      this.picture = user.picture;
      this.premiumUser = premium;
  }

  getPremiumUser(): Premium{
    return this.premiumUser;
  }

  getId(): number {
    return this.id;
  }
  getUsername(): String {
    return this.username;
  }
  getEmail(): String {
    return this.email;
  }
  getFirstname(): String {
    return this.firstname;
  }
  getName(): String {
    return this.name;
  }
  getBirthday(): Date {
    return this.birthday;
  }
  getGender(): String {
    return this.gender;
  }
  getStreet(): String {
    return this.street;
  }
  getPostalcode(): number {
    return this.postalCode;
  }
  getCity(): String {
    return this.city;
  }
  getIsPremium(): boolean {
    return this.isPremium;
  }
  getPicture(): String {
    return this.picture;
  }
  getHouseNumber(): String {
    return this.houseNumber;
  }

  setId(id: number){
    this.id = id;
  }

  setPremiumUser(){ 
  }

  setUsername(username: String): String {
    this.username = username;
    return this.username;
  }
  setEmail(email: String): String {
    this.email = email;
    return this.email;
  }
  setFirstname(firstname: String): String {
    this.firstname = firstname;
    return this.firstname;
  }
  setName(name: String): String {
    this.name = name;
    return this.name;
  }
  setBirthday(birthday: Date): Date {
    this.birthday = birthday;
    return this.birthday;
  }
  setGender(gender: String): String {
    this.gender = gender;
    return this.gender;
  }
 
  setPostalCode(postalCode: number): number {
    this.postalCode = postalCode;
    return this.postalCode;
  }
  setCity(city: String): String {
    this.city = city;
    return this.city;
  }
  setIsPremium(isPremium: boolean): boolean {
    this.isPremium = isPremium;
    return this.isPremium;
  }
  setPicture(picture: String): String {
    this.picture = picture;
    return this.picture;
  }
  setHouseNumber(street: String): String {
    this.street = street;
    return this.houseNumber;
  }

  setStreet(street: String){
    this.street = street;
  }

  convertAdress(): string{
    var adress = this.street;
    // let nr: string='';
var splitted = adress.split(" ");
// for(var i=splitted.length-1;i>=0;i--){
//   if(Number(splitted[i])>=0){
//    // console.log(splitted[i]);
//    // nr.concat(splitted[i]);
//     for(var j=i;j<=splitted.length-1;j++){

//       console.log(splitted[j]);
//       nr= splitted[i].concat(splitted[j]);

//     }
//   }


// console.log(nr);
// return nr;
//   }


var homenumber: string[]=[];
var homestreet: string[]=[];
let mark: number;

  for(var i=splitted.length-1;i>=0;i--){
    if(Number(splitted[i])>=0){
     // console.log(splitted[i]);
     // nr.concat(splitted[i]);
     mark=i-1;
      for(var j=i;j<=splitted.length-1;j++){
        homenumber.push(splitted[j]);

      }
    }

}

for(var i=0;i<=mark;i++){
  homestreet.push(splitted[i]);
}

this.houseNumber=homenumber.join(" ");
this.street=homestreet.join(" ");
return this.street + ' ' + this.houseNumber;
  }

  //////////////////////////////////////clean User Object//////////////////////////////////
  cleanUser() {
    this.id = null;
    this.username = '';
    this.email = '';
    this.firstname = '';
    this.name = '';
    this.birthday = null;
    this.houseNumber = null;
    this.gender = '';
    this.street = '';
    this.postalCode = null;
    this.city = '';
    this.isPremium = false;
  }
}
