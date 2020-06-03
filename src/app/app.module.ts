import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { FormsModule } from '@angular/forms';
import { from } from 'rxjs';

import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { LoginComponent } from './header/login/login.component';
import { RegComponent } from './header/reg/reg.component';
import { BenefitsComponent } from './header/benefits/benefits.component';
import { FooterComponent } from './footer/footer.component';
import { ImpressumComponent } from './footer/impressum/impressum.component';
import { DatenschutzComponent } from './footer/datenschutz/datenschutz.component';
import { ContentComponent } from './content/content.component';
import { SearchComponent } from './content/search/search.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    LoginComponent,
    RegComponent,
    BenefitsComponent,
    FooterComponent,
    ImpressumComponent,
    DatenschutzComponent,
    ContentComponent,
    SearchComponent,

  ],
  imports: [
    FormsModule,
    BrowserModule,
    ReactiveFormsModule,
    HttpClientModule,
    MatButtonModule,
    MatIconModule,
    RouterModule.forRoot([
      { path: 'home', component: ContentComponent },
      { path: 'login', component: LoginComponent },
      { path: 'reg', component: RegComponent },
      { path: 'benefits', component: BenefitsComponent },
      { path: 'impressum', component: ImpressumComponent },
      { path: 'datenschutz', component: DatenschutzComponent }
    ]),
  ],
  providers: [

  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
