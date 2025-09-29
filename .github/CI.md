# GitHub Actions CI/CD

This repository now includes automated testing and code quality checks via GitHub Actions.

## Workflow Triggers

The tests run automatically on:
- **Pull Request commits**: Any commit pushed to a pull request
- **Pull Request merges**: When changes are merged to the `main` branch

## What Gets Tested

1. **Code Style**: Laravel Pint checks for PSR-12 compliance and Laravel coding standards
2. **Unit Tests**: PestPHP test suite with attempted parallel execution (falls back to sequential if needed)
3. **Multi-PHP Support**: Tests run on PHP 8.2 and 8.3 to ensure compatibility

## Available Composer Scripts

- `composer run lint` - Fix code style issues
- `composer run lint:check` - Check code style without fixing (CI-friendly)
- `composer run test` - Run PestPHP tests with parallel support and fallback

## Workflow Features

- **Caching**: Composer dependencies are cached for faster builds
- **Matrix Testing**: Tests run on multiple PHP versions
- **Parallel Testing**: Attempts to run tests in parallel for speed, with graceful fallback
- **Fail-Fast Disabled**: All PHP versions are tested even if one fails

The workflow file is located at `.github/workflows/tests.yml`.