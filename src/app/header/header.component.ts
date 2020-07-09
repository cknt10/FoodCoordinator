import { Component, OnInit } from '@angular/core';
import { User } from '../User';
import { AuthenticationService } from '../authentication.service';
import { Router } from '@angular/router';
import { FindValueSubscriber } from 'rxjs/internal/operators/find';

@Component({
    selector: 'app-header',
    templateUrl: 'header.component.html',
    styleUrls: ['header.component.scss']
})

export class HeaderComponent implements OnInit{
  user: User;
  username: string;
  password: string;
  logedIn: boolean;

  constructor(
    private authenticationService: AuthenticationService,
    private router: Router,
  ) { }

  async ngOnInit() {
    this.getUser();
    this.logoutUser();
  }

  async getUser(){
    //const id = +this.route.snapshot.paramMap.get('id');
    this.user = await this.authenticationService.getUser();
  }

  async logoutUser(){
    console.log('start logout');
    await this.authenticationService.readUserData(this.username, this.password).then((user: User) =>{
      this.user = null;
    });
    this.router.navigate(['content']);
    this.logedIn = false;
  }

}
