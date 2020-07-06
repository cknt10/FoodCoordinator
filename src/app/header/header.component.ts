import { Component, OnInit } from '@angular/core';
import { User } from '../User';
import { AuthenticationService } from '../authentication.service';
import { Router } from '@angular/router';

@Component({
    selector: 'app-header',
    templateUrl: 'header.component.html',
    styleUrls: ['header.component.scss']
})

export class HeaderComponent implements OnInit{

  user: User;

  constructor(
    private authenticationService: AuthenticationService,
    private router: Router,
  ) { }

  ngOnInit() {
    this.getUser();
  }

  async getUser(){
    //const id = +this.route.snapshot.paramMap.get('id');
    this.user = this.authenticationService.getUser();
  }

}
