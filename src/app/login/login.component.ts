import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from '../authentication.service'

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  username: String;
  password: String;

  constructor(
    private authentication: AuthenticationService
    ) { }

  ngOnInit(): void {

  }

///////////////////////////////////////////////////////////http request to get user and password///////////////////////////////////////////////////////////////////
 async loginUser(username: String, password: String){

    console.log('start logging...');

//add parameter username and password
  this.authentication.getUser();

  }
}
