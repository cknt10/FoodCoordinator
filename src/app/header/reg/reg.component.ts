import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthenticationService } from '../../authentication.service';
import { LoginReqService } from '../../login-req.service';
import { FormControl } from '@angular/forms';
import { Cities } from 'src/app/cites';

@Component({
  selector: 'app-reg',
  templateUrl: './reg.component.html',
  styleUrls: ['./reg.component.scss'],
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

  postcodes: number[] = [];
  cities: Cities[] = [];
  drop = new FormControl();

  constructor(
    private router: Router,
    private authenticationReqService: AuthenticationService,
    private loginReqService: LoginReqService
  ) {}

  async ngOnInit() {
  }

  async getPostcode(){
    console.log(this.loginReqService.getServerCities(this.postalcode));
  }

  async regUser() {
    try {
      console.log(
        (
          await this.authenticationReqService.readUserData(
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
          )
        ).getFirstname()
      );
      this.router.navigate(['login']);
    } catch {
      window.alert("Bitte füllen Sie alle Felder aus!");
    }
  }

goBack(){
  this.router.navigate(['content']);
}

  throwError() {
    console.log(this.authenticationReqService.getErrorMessage());
    //window.alert(this.error);

    //for cities if there don't display
    console.log(this.loginReqService.getErrorMessage());
    //window.alert(this.error);
  }
}
