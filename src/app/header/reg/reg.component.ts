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

  usernameLogin: string;
  passwordLogin: string;

  constructor(
    private router: Router,
    private authentication: AuthenticationService
    ) { }

  ngOnInit() {
  }

  async regUser(){

    console.log((await this.authentication.readUserData(
      this.username,
      this.password,
      this.firstname,
      this.name,
      this.gender,
      this.street,
      this.housenumber.toString(),
      this.postalcode.toString(),
      this.city.toString(),
      this.birthday.toString(),
      this.email
      )).getFirstname());


  }

}
