import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { DatePipe } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { FormsModule } from '@angular/forms';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatAutocompleteModule } from '@angular/material/autocomplete';
import { MatMenuModule} from '@angular/material/menu';
import { ConstantsService } from './common/globals/constants.service';

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
import { RecipeDetailsComponent } from './content/recipe-details/recipe-details.component';
import { UserManagementComponent } from './content/user-management/user-management.component';
import { CookbookComponent } from './content/cookbook/cookbook.component';
import { MatSelectModule } from '@angular/material/select';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ChangeRecipeComponent } from './content/change-recipe/change-recipe.component';
import { MyFavoritesComponent } from './content/my-favorites/my-favorites.component';
import { NewcomerComponent } from './content/newcomer/newcomer.component';
import { GiftComponent } from './content/gift/gift.component';

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
    RecipeDetailsComponent,
    UserManagementComponent,
    ChangeRecipeComponent,
    CookbookComponent,
    MyFavoritesComponent,
    NewcomerComponent,
    GiftComponent,

  ],

  imports: [
    MatSelectModule,
    FormsModule,
    BrowserModule,
    BrowserAnimationsModule,
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
      { path: 'detail/:id', component: RecipeDetailsComponent },
      { path: 'datenschutz', component: DatenschutzComponent },
      { path: 'cookbook', component: CookbookComponent },
      { path: 'change/:id', component: ChangeRecipeComponent },
      { path: 'account', component: UserManagementComponent },
    ]),
  ],
  providers: [DatePipe, ConstantsService],
  bootstrap: [AppComponent],
})
export class AppModule { }
