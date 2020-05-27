import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { FormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { LoginComponent } from './login/login.component';
import { RegComponent } from './reg/reg.component';
import { BenefitsComponent } from './benefits/benefits.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    LoginComponent,
    RegComponent,
    BenefitsComponent,

  ],
  imports: [
    FormsModule,
    BrowserModule,
    ReactiveFormsModule,
    HttpClientModule,
    MatButtonModule,
    MatIconModule,
    RouterModule.forRoot([
      { path: 'login', component: LoginComponent },
      { path: 'reg', component: RegComponent },
      { path: 'vorteile', component: BenefitsComponent }
    ]),
  ],
  providers: [

  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
