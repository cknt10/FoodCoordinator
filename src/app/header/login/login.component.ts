import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from '../../authentication.service';
import { LoginReqService } from 'src/app/login-req.service';
import { Router } from '@angular/router';
import { User } from 'src/app/User';
import { PremiumReqService } from 'src/app/premium-req.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  username: string;
  password: string;
  user: User;

  constructor(
    private router: Router,
    private authenticationService: AuthenticationService,
    private premiumReqService: PremiumReqService,
    ) { }

  ngOnInit(): void {

  }

///////////////////////////////////////////////////////////http request to get user and password///////////////////////////////////////////////////////////////////
  async loginUser(){
    console.log('start logging...');
    //add parameter username and password
    await this.authenticationService.readUserData(this.username, this.password);
    this.user = this.authenticationService.getUser();
    this.router.navigate(['content']);
  }

  goBack(){
    this.router.navigate(['content']);
  }

  throwError() {
    console.log(this.authenticationService.getErrorMessage());
    //window.alert(this.error);
  }

}
