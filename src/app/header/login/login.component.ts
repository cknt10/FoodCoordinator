import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from '../../authentication.service';
import { LoginReqService } from 'src/app/login-req.service';

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
    private authenticationService: AuthenticationService, 
    ) { }

  ngOnInit(): void {

  }

///////////////////////////////////////////////////////////http request to get user and password///////////////////////////////////////////////////////////////////
  async loginUser(){
    console.log('start logging...');
    //add parameter username and password
    console.log((await this.authenticationService.readUserData(this.username, this.password)));

    this.loggedIn = true;

    if (this.loggedIn){
      this.log = "Logout";
    }
    else{
      this.log = "Login";
    }
  }

  throwError() {
    console.log(this.authenticationService.getErrorMessage());
    //window.alert(this.error);
  }

}
