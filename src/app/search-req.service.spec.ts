import { TestBed } from '@angular/core/testing';

import { SearchReqService } from './search-req.service';

describe('SearchReqService', () => {
  let service: SearchReqService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(SearchReqService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
