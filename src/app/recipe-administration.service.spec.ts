import { TestBed } from '@angular/core/testing';

import { RecipeAdministrationService } from './recipe-administration.service';

describe('RecipeAdministrationService', () => {
  let service: RecipeAdministrationService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(RecipeAdministrationService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
