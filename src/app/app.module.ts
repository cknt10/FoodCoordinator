import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';
<<<<<<< HEAD
import {MatButtonModule} from '@angular/material/button';

import { AppComponent } from './app.component';
import { HeaderComponent} from './header/header.component';
import { LoginComponent } from './login/login.component';
import { from } from 'rxjs';
=======
import { MatButtonModule } from '@angular/material/button';


import { AppComponent } from './app.component';
import { HeaderComponent} from './header/header.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
>>>>>>> anna


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    LoginComponent,

  ],
  imports: [
    BrowserModule,
    ReactiveFormsModule,
    HttpClientModule,
    MatButtonModule,
    RouterModule.forRoot([
//Vielleicht stehen die Komponenten hier für den outlet
<<<<<<< HEAD
{ path: 'login', component: LoginComponent},
    ]),
=======
    ]),
    BrowserAnimationsModule
>>>>>>> anna
  ],
  providers: [


  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
