import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthenticationService } from '../../authentication.service';
import { LoginReqService } from '../../login-req.service';

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

  constructor(
    private router: Router,
    private authenticationReqService: AuthenticationService,
    private loginReqService: LoginReqService
  ) {}

  async ngOnInit() {
  }

  async getPostcode(){
    await this.loginReqService.getServerCities(this.postalcode);
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
    } catch {
      window.alert("Bitte füllen Sie alle Felder aus!");
    }
  }

  throwError() {
    console.log(this.authenticationReqService.getErrorMessage());
    //window.alert(this.error);

    //for cities if there don't display
    console.log(this.loginReqService.getErrorMessage());
    //window.alert(this.error);
  }
}
