import { TestBed } from '@angular/core/testing';

import { LoginReqService } from './login-req.service';

describe('LoginReqService', () => {
  let service: LoginReqService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(LoginReqService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
