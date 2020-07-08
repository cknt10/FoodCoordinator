import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from './../../authentication.service';
import { UserManagementServiceReqService } from './../../user-management-service-req.service';
import { User } from '../../User';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-management',
  templateUrl: './user-management.component.html',
  styleUrls: ['./user-management.component.css']
})
export class UserManagementComponent implements OnInit {
  user: User;

  firstname: String;
  name: String;
  gender: String;
  street: String;
  houseNumber: String;
  postalCode: number;
  city: String;
  birthday: Date;
  username: String;
  email: String;
  emailConfirm: String;// finde ich nicht nötig
  password: string; // sollte, da man es ohnehin nicht shene kann und nicht weiß was drin ist, leer lassen
  passwordConfirm: String;//Kontrolle der beiden n icht vergessen :)
  picture: String;

  constructor(
    private router: Router,
    private authenticationService: AuthenticationService,
    private userManagement: UserManagementServiceReqService
  ) { }

  ngOnInit(): void {
    this.getUser();
    this.setValue();
  }

  async getUser(){
    //const id = +this.route.snapshot.paramMap.get('id');
    this.user = this.authenticationService.getUser();
    console.log(this.user);
  }

  setValue() {
    this.firstname = this.user.getFirstname();
    this.name = this.user.getName();
    this.gender = this.user.getGender();
    this.street = this.user.getStreet();
    this.houseNumber = this.user.getHouseNumber();
    this.postalCode = this.user.getPostalcode();
    this.city = this.user.getCity();
    this.birthday = this.user.getBirthday();
    this.username = this.user.getUsername();
    this.email = this.user.getEmail();
    this.picture = this.user.getPicture();
    console.log(this.user);
  }

  async safe(){
    if(this.password == this.passwordConfirm && this.email == this.emailConfirm){
      await this.userManagement.changeUserData(
        this.user.getId(),
        this.username,
        this.password,
        this.firstname,
        this.name,
        this.gender,
        this.street,
        this.houseNumber,
        this.postalCode,
        this.city,
        this.birthday,
        this.email,
        this.picture
        );
      //await this.userManagement.postchangePassword( this.password, this.user.getId());
      //@Frontend, wenn erfolreich dann set-Methode um die lokalen Werte des Users zu überschreiben
      window.alert('Ihre Daten wurden erfolgreich geändert.');
    }
    else{
      window.alert('Bitte alle Felder ausfüllen oder die Email / das Passwort überprüfen.');
    }
  }

}
