import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class ContentService {
  private apiUrl = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient) {}

  getHeaderContent(): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/header-content`);
  }
  getHeroContent(): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/workshops`);
  }
  // getMembers(): Observable<any> {
  //   return this.http.get<any>(`${this.apiUrl}/news`);
  // }
}
