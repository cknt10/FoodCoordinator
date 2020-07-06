import { Component, OnInit, ViewChild } from '@angular/core';
import { MatMenuTrigger } from '@angular/material/menu';
import { User } from 'src/app/User';
import { AuthenticationService } from '../../authentication.service';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.scss']
})
export class MenuComponent implements OnInit {
  @ViewChild(MatMenuTrigger) trigger: MatMenuTrigger;
  user: User;

  constructor(
    private authenticationService: AuthenticationService,
  ) { }

  ngOnInit(): void {
    this.getUser();
  }

  async getUser(){
    //const id = +this.route.snapshot.paramMap.get('id');
    this.user = this.authenticationService.getUser();
  }

  someMethod() {
    this.trigger.openMenu();
  }

}
