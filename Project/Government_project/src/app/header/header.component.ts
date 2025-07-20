import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { ContentService } from '../services/content.service';

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [CommonModule, HttpClientModule],
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css'],
})
export class HeaderComponent implements OnInit {
  headerData: any;
  navbarActive = false;

  constructor(private contentService: ContentService) {}

  ngOnInit(): void {
    this.loadHeaderContent();
  }

  loadHeaderContent() {
    this.contentService.getHeaderContent().subscribe((data) => {
      this.headerData = data;
      console.log(this.headerData);
    });
  }

  toggleNavbar() {
    this.navbarActive = !this.navbarActive;
  }
}
