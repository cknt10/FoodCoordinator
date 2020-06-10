import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from '../../authentication.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  username: String;
  password: String;

  constructor(private authenticationService: AuthenticationService) {

  }

  ngOnInit(): void {

  }

///////////////////////////////////////////////////////////http request to get user and password///////////////////////////////////////////////////////////////////
 async loginUser(){

    console.log('start logging...');

//add parameter username and password

   console.log((await this.authenticationService.setUserData()).getFirstname());
   }



}
