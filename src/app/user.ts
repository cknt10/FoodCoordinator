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
  private houseNumber: number;
  private postcode: number;
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
      this.postcode = user.postcode;
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
    return this.postcode;
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
  getHouseNumber(): number {
    return this.houseNumber;
  }

  setId(id: number){
    this.id = id;
  }

  setStreet(street: string){
    this.street = street;
  }

  convertAdress(){
    var adress = this.street;
    let nr: string='';
var splitted = adress.split(" ");
for(var i=splitted.length-1;i>=0;i--){
  if(Number(splitted[i])>=0){
    console.log(splitted[i]);
    nr.concat(splitted[i]);
    /*for(var j=i;j<=adress.length-1;j++){
      console.log(splitted[i]);
      //nr.concat(splitted[j]);
    }*/
  }

}
console.log(splitted);
return nr;
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
    this.postcode = null;
    this.city = '';
    this.isPremium = false;
  }
}
