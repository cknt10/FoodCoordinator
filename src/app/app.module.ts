import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { DatePipe } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { FormsModule } from '@angular/forms';
import {MatFormFieldModule} from '@angular/material/form-field';
import {MatAutocompleteModule} from '@angular/material/autocomplete';
import { MatMenuModule} from '@angular/material/menu';

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
import { CreateRecipeComponent } from './content/create-recipe/create-recipe.component';
import { MenuComponent } from './content/menu/menu.component';
import { MyRecipesComponent } from './content/my-recipes/my-recipes.component';
import { SearchResultComponent } from './content/search-result/search-result.component';

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
    CreateRecipeComponent,
    MenuComponent,
    MyRecipesComponent,
    SearchResultComponent,

  ],
  imports: [
    FormsModule,
    BrowserModule,
    ReactiveFormsModule,
    HttpClientModule,
    MatButtonModule,
    MatIconModule,
    MatFormFieldModule,
    MatAutocompleteModule,
    MatMenuModule,
    RouterModule.forRoot([
      { path: '',   redirectTo: '/content', pathMatch: 'full' },
      { path: 'content', component: ContentComponent },
      { path: 'login', component: LoginComponent },
      { path: 'reg', component: RegComponent },
      { path: 'createrecipe', component: CreateRecipeComponent },
      { path: 'myrecipes', component: MyRecipesComponent },
      { path: 'benefits', component: BenefitsComponent },
      { path: 'impressum', component: ImpressumComponent },
      { path: 'datenschutz', component: DatenschutzComponent }
    ]),
  ],
  providers: [DatePipe],
  bootstrap: [AppComponent]
})
export class AppModule { }
