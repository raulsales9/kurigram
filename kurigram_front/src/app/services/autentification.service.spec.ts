import { TestBed } from '@angular/core/testing';

import { AutentificationService } from './autentification.service';

describe('AutentificationService', () => {
  let service: AutentificationService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AutentificationService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
