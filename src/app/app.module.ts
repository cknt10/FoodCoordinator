import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { MatButtonModule } from '@angular/material/button';


import { AppComponent } from './app.component';
import { HeaderComponent} from './header/header.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,

  ],
  imports: [
    BrowserModule,
    ReactiveFormsModule,
    HttpClientModule,
    MatButtonModule,
    RouterModule.forRoot([
//Vielleicht stehen die Komponenten hier für den outlet
    ]),
    BrowserAnimationsModule
  ],
  providers: [


  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
