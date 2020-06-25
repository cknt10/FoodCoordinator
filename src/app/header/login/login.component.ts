import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from '../../authentication.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  username: string;
  password: string;
  loggedIn: boolean = false;
  log: string = "Login";

  constructor(
    private authenticationService: AuthenticationService
    ) { }

  ngOnInit(): void {

  }

///////////////////////////////////////////////////////////http request to get user and password///////////////////////////////////////////////////////////////////
  async loginUser(){
    console.log('start logging...');
    //add parameter username and password
    console.log((await this.authenticationService.setUserData(this.username, this.password)).getFirstname());
    //return user?

    this.loggedIn = true;

    if (this.loggedIn){
      this.log = "Logout";
    }
    else{
      this.log = "Login";
    }
  }

}
