# Brand Color Palette

## 🎨 Primary Colors

### Primary Blue - `#2176C1`
- **Usage**: Main brand color, navbar links, primary buttons, headings
- **Hover**: `#1e6bb0`
- **Light variant**: `rgba(33, 118, 193, 0.1)`

### Secondary Yellow - `#FED31A`
- **Usage**: Accent elements, CTA highlights, mega-menu titles
- **Hover**: `#e6c018`
- **Light variant**: `rgba(254, 211, 26, 0.1)`

### Accent Red - `#EF3A3F`
- **Usage**: Important alerts, emergency buttons, special highlights
- **Hover**: `#d32f2f`
- **Light variant**: `rgba(239, 58, 63, 0.1)`

### Text Black - `#000000`
- **Usage**: Main text, headings, strong emphasis
- **Muted variant**: `#666666` (for better readability)

## 🔧 CSS Variables

```css
:root {
    --primary-color: #2176C1;      /* Brand Blue */
    --secondary-color: #FED31A;    /* Brand Yellow */
    --accent-color: #EF3A3F;       /* Brand Red */
    --text-dark: #000000;          /* Brand Black */
    --text-muted: #666666;         /* Softer black */
    --primary-hover: #1e6bb0;      /* Hover states */
    --secondary-hover: #e6c018;    
    --accent-hover: #d32f2f;       
}
```

## 🎯 Button Classes Available

### Primary Button (Blue)
```html
<a href="#" class="btn-custom-outline">Learn More</a>
```

### Secondary Button (Yellow)
```html
<a href="#" class="btn-custom-yellow">Get Started</a>
```

### Accent Button (Red)
```html
<a href="#" class="btn-custom-red">Important Action</a>
```

## 🌈 Usage Guidelines

1. **Primary Blue**: Use for main navigation, primary CTAs, and brand elements
2. **Secondary Yellow**: Use for highlights, secondary CTAs, and accent elements
3. **Accent Red**: Use sparingly for urgent/important actions only
4. **Black**: Use for body text and content readability

## 📱 Accessibility

All color combinations meet WCAG AA contrast requirements:
- Blue (#2176C1) on white: ✅ AA
- Yellow (#FED31A) on black: ✅ AA
- Red (#EF3A3F) on white: ✅ AA
- Black (#000000) on white: ✅ AAA

## 🎨 Background Variants

- `.bg-primary-light`: Light blue background
- `.bg-secondary-light`: Light yellow background  
- `.bg-accent-light`: Light red background
- `.accent-yellow`: Yellow text color
- `.accent-red`: Red text color