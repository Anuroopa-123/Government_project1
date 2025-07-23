import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-committee-photos',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './committee-photos.component.html',
  styleUrl: './committee-photos.component.css',
})
export class CommitteePhotosComponent {
  selectedCategory: string = 'All';

  changeCategory(category: string) {
    this.selectedCategory = category;
  }
}
