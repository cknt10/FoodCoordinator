import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import {MatButtonModule} from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';

import { AppComponent } from './app.component';
import { HeaderComponent} from './header/header.component';
import { LoginComponent } from './login/login.component';
import { from } from 'rxjs';
import { RegComponent } from './reg/reg.component';
import { VorteileComponent } from './vorteile/vorteile.component';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    LoginComponent,
    RegComponent,
    VorteileComponent,

  ],
  imports: [
    BrowserModule,
    ReactiveFormsModule,
    HttpClientModule,
    MatButtonModule,
    MatIconModule,
    RouterModule.forRoot([
//Vielleicht stehen die Komponenten hier für den outlet
{ path: 'login', component: LoginComponent},
    ]),
  ],
  providers: [


  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
