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

  constructor(user: User) {
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
