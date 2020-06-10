import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthenticationService } from '../../authentication.service';

@Component({
  selector: 'app-reg',
  templateUrl: './reg.component.html',
  styleUrls: ['./reg.component.scss']
})
export class RegComponent implements OnInit {

  firstname: string;
  name: string;
  gender: string;
  street: string;
  housenumber: number;
  postalcode: number;
  city: string;
  birthday: Date;
  username: string;
  email: string;
  emailConfirm: string;
  password: string;
  passwordConfirm: string;
  image: File;

  usernameLogin: string;
  passwordLogin: string;

  constructor(
    private router: Router,
    private registrationService: AuthenticationService) { }

  ngOnInit(): void {
  }

  regUser(){
    if(
      this.firstname != null &&
      this.name != null &&
      this.gender != null &&
      this.street != null &&
      this.housenumber != null &&
      this.postalcode != null &&
      this.city != null &&
      this.username != null &&
      this.password != null &&
      this.email != null &&
      this.email == this.emailConfirm &&
      this.password == this.passwordConfirm){
      window.alert ("Registrierung erfolgreich! Sie werden weitergeleitet");
      setTimeout(()=> { this.router.navigate(['login']) }, 2000);
    }
    else{
      window.alert ("Registrierung fehlgeschlagen. Bitte prüfe deine Eingaben!");
    }
  }

}
