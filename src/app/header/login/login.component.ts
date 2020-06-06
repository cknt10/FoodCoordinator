import { Component, OnInit } from '@angular/core';
<<<<<<< HEAD:src/app/login/login.component.ts
import { AuthenticationService } from '../authentication.service'
=======
import { AuthenicationService } from '../../authenication.service'
import { User } from '../../User';
>>>>>>> master:src/app/header/login/login.component.ts

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  username: String;
  password: String;

  constructor(
    private authenticationService: AuthenticationService
    ) { }

  ngOnInit(): void {

  }

///////////////////////////////////////////////////////////http request to get user and password///////////////////////////////////////////////////////////////////
 async loginUser(){

    console.log('start logging...');

//add parameter username and password

   console.log((await this.authenticationService.setUserData()).getFirstname());
   }



}
