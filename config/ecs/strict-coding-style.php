<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\DisallowLongArraySyntaxSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Classes\DuplicateClassNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\ControlStructures\DisallowYodaConditionsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Functions\CallTimePassByReferenceSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\NestingLevelSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\ConstructorNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\UpperCaseConstantNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\BacktickOperatorSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\CharacterBeforePHPOpeningTagSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DeprecatedFunctionsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DisallowAlternativePHPTagsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DisallowShortOpenTagSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DiscourageGotoSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\LowerCaseConstantSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\LowerCaseKeywordSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\LowerCaseTypeSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\NoSilencedErrorsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Strings\UnnecessaryStringConcatSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace\DisallowSpaceIndentSniff;
use PHP_CodeSniffer\Standards\MySource\Sniffs\Objects\AssignThisSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\ControlStructures\MultiLineConditionSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\Files\IncludingFileSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\ControlStructures\ControlStructureSpacingSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Methods\FunctionCallSignatureSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Methods\MethodDeclarationSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Namespaces\NamespaceDeclarationSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Namespaces\UseDeclarationSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayBracketSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\ClassFileNameSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\DuplicatePropertySniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\LowercaseClassKeywordsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\SelfMemberReferenceSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\ValidClassNameSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Functions\FunctionDeclarationSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Functions\MultiLineFunctionDeclarationSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Operators\IncrementDecrementUsageSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Operators\ValidLogicalOperatorsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\DisallowMultipleAssignmentsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\DiscouragedFunctionsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\EvalSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\GlobalKeywordSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\LowercasePHPFunctionsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\NonExecutableCodeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Scope\MemberVarScopeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Scope\MethodScopeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Scope\StaticThisUsageSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Strings\ConcatenationSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Strings\DoubleQuoteUsageSniff;
use PhpCsFixer\Fixer\Alias\MbStrFunctionsFixer;
use PhpCsFixer\Fixer\ArrayNotation\YieldFromArrayToYieldsFixer;
use PhpCsFixer\Fixer\Basic\SingleLineEmptyBodyFixer;
use PhpCsFixer\Fixer\ClassNotation\FinalInternalClassFixer;
use PhpCsFixer\Fixer\Comment\CommentToPhpdocFixer;
use PhpCsFixer\Fixer\DoctrineAnnotation\DoctrineAnnotationSpacesFixer;
use PhpCsFixer\Fixer\FunctionNotation\NullableTypeDeclarationForDefaultNullValueFixer;
use PhpCsFixer\Fixer\FunctionNotation\SingleLineThrowFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\GlobalNamespaceImportFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAlignFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocLineSpanFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSeparationFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitInternalClassFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMethodCasingFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestCaseStaticMethodCallsFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestClassRequiresCoversFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\Semicolon\MultilineWhitespaceBeforeSemicolonsFixer;
use SlevomatCodingStandard\Sniffs\Arrays\MultiLineArrayEndBracketPlacementSniff;
use SlevomatCodingStandard\Sniffs\Arrays\SingleLineArrayWhitespaceSniff;
use SlevomatCodingStandard\Sniffs\Arrays\TrailingArrayCommaSniff;
use SlevomatCodingStandard\Sniffs\Classes\BackedEnumTypeSpacingSniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassConstantVisibilitySniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassMemberSpacingSniff;
use SlevomatCodingStandard\Sniffs\Classes\ConstantSpacingSniff;
use SlevomatCodingStandard\Sniffs\Classes\DisallowMultiConstantDefinitionSniff;
use SlevomatCodingStandard\Sniffs\Classes\DisallowMultiPropertyDefinitionSniff;
use SlevomatCodingStandard\Sniffs\Classes\ModernClassNameReferenceSniff;
use SlevomatCodingStandard\Sniffs\Classes\PropertyDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Classes\RequireMultiLineMethodSignatureSniff;
use SlevomatCodingStandard\Sniffs\Classes\TraitUseDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Classes\UselessLateStaticBindingSniff;
use SlevomatCodingStandard\Sniffs\Commenting\DeprecatedAnnotationDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Commenting\DisallowOneLinePropertyDocCommentSniff;
use SlevomatCodingStandard\Sniffs\Commenting\InlineDocCommentDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Commenting\UselessFunctionDocCommentSniff;
use SlevomatCodingStandard\Sniffs\Commenting\UselessInheritDocCommentSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\DisallowEmptySniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\DisallowYodaComparisonSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireMultiLineTernaryOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullCoalesceEqualOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullCoalesceOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullSafeObjectOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireTernaryOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\UselessTernaryOperatorSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\RequireNonCapturingCatchSniff;
use SlevomatCodingStandard\Sniffs\Functions\RequireArrowFunctionSniff;
use SlevomatCodingStandard\Sniffs\Functions\RequireTrailingCommaInCallSniff;
use SlevomatCodingStandard\Sniffs\Functions\RequireTrailingCommaInDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Functions\StaticClosureSniff;
use SlevomatCodingStandard\Sniffs\Functions\StrictCallSniff;
use SlevomatCodingStandard\Sniffs\Functions\UnusedInheritedVariablePassedToClosureSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\ReferenceUsedNamesOnlySniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UnusedUsesSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UselessAliasSniff;
use SlevomatCodingStandard\Sniffs\Operators\RequireCombinedAssignmentOperatorSniff;
use SlevomatCodingStandard\Sniffs\Operators\SpreadOperatorSpacingSniff;
use SlevomatCodingStandard\Sniffs\PHP\ForbiddenClassesSniff;
use SlevomatCodingStandard\Sniffs\PHP\OptimizedFunctionsWithoutUnpackingSniff;
use SlevomatCodingStandard\Sniffs\PHP\RequireNowdocSniff;
use SlevomatCodingStandard\Sniffs\PHP\ShortListSniff;
use SlevomatCodingStandard\Sniffs\PHP\TypeCastSniff;
use SlevomatCodingStandard\Sniffs\PHP\UselessParenthesesSniff;
use SlevomatCodingStandard\Sniffs\PHP\UselessSemicolonSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\NullTypeHintOnLastPositionSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\PropertyTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\UnionTypeHintFormatSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\UselessConstantTypeHintSniff;
use SlevomatCodingStandard\Sniffs\Variables\UnusedVariableSniff;
use SlevomatCodingStandard\Sniffs\Variables\UselessVariableSniff;
use SlevomatCodingStandard\Sniffs\Whitespaces\DuplicateSpacesSniff;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayListItemNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\StandaloneLineInMultilineArrayFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\CodingStandard\Fixer\Spacing\MethodChainingNewlineFixer;
use Symplify\CodingStandard\Fixer\Spacing\SpaceAfterCommaHereNowDocFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): array {
    $skip = [];

    $ecsConfig->dynamicSets(['@PhpCsFixer']);
    $ecsConfig->ruleWithConfiguration(MultilineWhitespaceBeforeSemicolonsFixer::class, ['strategy' => MultilineWhitespaceBeforeSemicolonsFixer::STRATEGY_NO_MULTI_LINE]);
    $skip[] = PhpUnitMethodCasingFixer::class;
    $skip[] = PhpUnitInternalClassFixer::class;
    $skip[] = PhpUnitTestClassRequiresCoversFixer::class;
    $skip[] = SingleLineEmptyBodyFixer::class;
    // https://github.com/FriendsOfPHP/PHP-CS-Fixer/issues/3858
    $skip[] = ReturnAssignmentFixer::class;

    $ecsConfig->dynamicSets(['@PhpCsFixer:risky']);
    $ecsConfig->ruleWithConfiguration(PhpUnitTestCaseStaticMethodCallsFixer::class, ['call_type' => PhpUnitTestCaseStaticMethodCallsFixer::CALL_TYPE_SELF]);
    $skip[] = CommentToPhpdocFixer::class;
    $skip[] = PhpUnitStrictFixer::class;

    $ecsConfig->import(SetList::CLEAN_CODE);

    $ecsConfig->dynamicSets(['@Symfony']);
    $skip[] = SingleLineThrowFixer::class;
    $skip[] = PhpdocAlignFixer::class;
    $skip[] = PhpdocSeparationFixer::class;
    $skip[] = GlobalNamespaceImportFixer::class;
    $ecsConfig->ruleWithConfiguration(NullableTypeDeclarationForDefaultNullValueFixer::class, ['use_nullable_type_declaration' => true]);

    $ecsConfig->dynamicSets(['@Symfony:risky']);

    $ecsConfig->import(SetList::DOCTRINE_ANNOTATIONS);
    $ecsConfig->ruleWithConfiguration(DoctrineAnnotationSpacesFixer::class, ['after_argument_assignments' => true, 'before_argument_assignments' => true]);

    $ecsConfig->import(SetList::COMMON);
    $skip[] = ArrayListItemNewlineFixer::class;
    $skip[] = ArrayOpenerAndCloserNewlineFixer::class;
    $skip[] = StandaloneLineInMultilineArrayFixer::class;
    $skip[] = AssignmentInConditionSniff::class.'.FoundInWhileCondition';
    $skip[] = PhpdocLineSpanFixer::class;

    $ecsConfig->import(SetList::SYMPLIFY);
    $ecsConfig->ruleWithConfiguration(GeneralPhpdocAnnotationRemoveFixer::class, ['annotations' => ['author', 'package', 'covers']]);
    $skip[] = LineLengthFixer::class;
    $skip[] = MethodChainingNewlineFixer::class;
    $skip[] = SpaceAfterCommaHereNowDocFixer::class;

    $ecsConfig->import(SetList::PSR_12);
    $ecsConfig->ruleWithConfiguration(ConcatSpaceFixer::class, ['spacing' => 'none']);

    $ecsConfig->import(SetList::ARRAY);

    $ecsConfig->import(SetList::STRICT);

    // Custom fixers

    $ecsConfig->rule(NullableTypeDeclarationForDefaultNullValueFixer::class);
    // https://github.com/slevomat/coding-standard/issues/1319
    // $ecsConfig->rule(DisallowDirectMagicInvokeCallSniff::class);
    $ecsConfig->ruleWithConfiguration(UnusedVariableSniff::class, ['ignoreUnusedValuesWhenOnlyKeysAreUsedInForeach' => true]);
    $ecsConfig->rule(UselessVariableSniff::class);
    $ecsConfig->rule(UnusedInheritedVariablePassedToClosureSniff::class);
    $ecsConfig->rule(UselessSemicolonSniff::class);
    $ecsConfig->rule(UselessParenthesesSniff::class);
    $ecsConfig->rule(OptimizedFunctionsWithoutUnpackingSniff::class);
    $ecsConfig->ruleWithConfiguration(
        UnusedUsesSniff::class,
        [
            'searchAnnotations' => true,
            'ignoredAnnotations' => ['@dataProvider'],
        ],
    );

    $ecsConfig->rule(RequireCombinedAssignmentOperatorSniff::class);
    $ecsConfig->rule(DisallowMultiConstantDefinitionSniff::class);
    $ecsConfig->rule(DisallowMultiPropertyDefinitionSniff::class);
    $ecsConfig->rule(ModernClassNameReferenceSniff::class);
    $ecsConfig->rule(RequireMultiLineMethodSignatureSniff::class);
    $ecsConfig->rule(TraitUseDeclarationSniff::class);
    $ecsConfig->rule(UselessAliasSniff::class);
    $ecsConfig->ruleWithConfiguration(DuplicateSpacesSniff::class, ['ignoreSpacesInAnnotation' => true]);
    $ecsConfig->rule(ClassConstantVisibilitySniff::class);
    $ecsConfig->rule(UselessLateStaticBindingSniff::class);
    $ecsConfig->rule(UselessInheritDocCommentSniff::class);
    $ecsConfig->rule(DisallowYodaConditionsSniff::class);
    $ecsConfig->rule(DisallowYodaComparisonSniff::class);
    $ecsConfig->rule(SpreadOperatorSpacingSniff::class);
    $ecsConfig->ruleWithConfiguration(UnusedVariableSniff::class, ['ignoreUnusedValuesWhenOnlyKeysAreUsedInForeach' => true]);
    $ecsConfig->rule(RequireNowdocSniff::class);
    $ecsConfig->rule(RequireNonCapturingCatchSniff::class);
    $ecsConfig->rule(DisallowEmptySniff::class);
    $ecsConfig->rule(RequireNullCoalesceOperatorSniff::class);
    $ecsConfig->rule(RequireNullCoalesceEqualOperatorSniff::class);
    $ecsConfig->rule(UselessConstantTypeHintSniff::class);
    $ecsConfig->rule(UnionTypeHintFormatSniff::class);
    $ecsConfig->rule(ParameterTypeHintSniff::class);
    $skip[] = ParameterTypeHintSniff::class.'.MissingAnyTypeHint';
    $skip[] = ParameterTypeHintSniff::class.'.MissingTraversableTypeHintSpecification';
    $ecsConfig->rule(PropertyTypeHintSniff::class);
    $skip[] = PropertyTypeHintSniff::class.'.MissingAnyTypeHint';
    $skip[] = PropertyTypeHintSniff::class.'.MissingTraversableTypeHintSpecification';
    $ecsConfig->rule(ReturnTypeHintSniff::class);
    $skip[] = ReturnTypeHintSniff::class.'.MissingAnyTypeHint';
    $skip[] = ReturnTypeHintSniff::class.'.MissingTraversableTypeHintSpecification';
    $ecsConfig->rule(MultiLineArrayEndBracketPlacementSniff::class);
    $ecsConfig->rule(SingleLineArrayWhitespaceSniff::class);
    $ecsConfig->rule(TrailingArrayCommaSniff::class);
    $ecsConfig->rule(RequireMultiLineTernaryOperatorSniff::class);
    $ecsConfig->rule(RequireNullSafeObjectOperatorSniff::class);
    $ecsConfig->rule(RequireTernaryOperatorSniff::class);

    $ecsConfig->rule(StaticClosureSniff::class);
    $ecsConfig->rule(RequireArrowFunctionSniff::class);
    $ecsConfig->rule(UselessFunctionDocCommentSniff::class);
    $ecsConfig->rule(ClassMemberSpacingSniff::class);
    $ecsConfig->rule(ConstantSpacingSniff::class);
    $ecsConfig->rule(StrictCallSniff::class);
    $ecsConfig->ruleWithConfiguration(
        ForbiddenClassesSniff::class,
        [
            'forbiddenClasses' => [
                'DateTime' => null, // Use DateTimeImmutable instead.
                'AppendIterator' => null, // AppendIterator has a nasty bug with Generators, it's better to not use it: https://bugs.php.net/bug.php?id=72692
                'Monolog\\Test\\TestCase' => null, // Use PHPUnit\Framework\TestCase.
            ],
        ],
    );
    $ecsConfig->rule(RequireTrailingCommaInDeclarationSniff::class);
    $ecsConfig->rule(RequireTrailingCommaInCallSniff::class);
    $ecsConfig->rule(NullTypeHintOnLastPositionSniff::class);
    $ecsConfig->rule(ShortListSniff::class);
    $ecsConfig->rule(TypeCastSniff::class);
    $ecsConfig->rule(DeprecatedAnnotationDeclarationSniff::class);
    $ecsConfig->rule(InlineDocCommentDeclarationSniff::class);
    $ecsConfig->rule(DisallowOneLinePropertyDocCommentSniff::class);
    $ecsConfig->rule(UselessInheritDocCommentSniff::class);
    $ecsConfig->rule(UselessTernaryOperatorSniff::class);

    $ecsConfig->ruleWithConfiguration(
        LineLengthFixer::class,
        [
            'line_length' => 120,
            'inline_short_lines' => false,
        ],
    );

    $ecsConfig->rule(VoidReturnFixer::class);
    // https://github.com/squizlabs/PHP_CodeSniffer/issues/3842
    // $ecsConfig->rule(\PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\ClassDeclarationSniff::class);
    $ecsConfig->rule(ClassFileNameSniff::class);
    $ecsConfig->rule(SelfMemberReferenceSniff::class);
    $ecsConfig->rule(DuplicatePropertySniff::class);
    $ecsConfig->rule(LowercaseClassKeywordsSniff::class);
    $ecsConfig->rule(ValidClassNameSniff::class);
    $ecsConfig->rule(FunctionDeclarationSniff::class);
    $ecsConfig->rule(MultiLineFunctionDeclarationSniff::class);
    $ecsConfig->rule(IncrementDecrementUsageSniff::class);
    $ecsConfig->rule(ValidLogicalOperatorsSniff::class);
    $ecsConfig->rule(ArrayBracketSpacingSniff::class);
    $ecsConfig->rule(DoubleQuoteUsageSniff::class);
    $ecsConfig->rule(ConcatenationSpacingSniff::class);
    $ecsConfig->rule(LowercasePHPFunctionsSniff::class);
    $ecsConfig->rule(DisallowMultipleAssignmentsSniff::class);
    $ecsConfig->rule(DiscouragedFunctionsSniff::class);
    $ecsConfig->rule(EvalSniff::class);
    $ecsConfig->rule(GlobalKeywordSniff::class);
    $ecsConfig->rule(NonExecutableCodeSniff::class);
    $ecsConfig->rule(MemberVarScopeSniff::class);
    $ecsConfig->rule(MethodScopeSniff::class);
    $ecsConfig->rule(StaticThisUsageSniff::class);
    $ecsConfig->rule(AssignThisSniff::class);
    $ecsConfig->rule(DisallowLongArraySyntaxSniff::class);
    $ecsConfig->rule(DuplicateClassNameSniff::class);
    $ecsConfig->rule(UnnecessaryStringConcatSniff::class);
    $ecsConfig->rule(BacktickOperatorSniff::class);
    $ecsConfig->rule(DeprecatedFunctionsSniff::class);
    $ecsConfig->rule(CharacterBeforePHPOpeningTagSniff::class);
    $ecsConfig->rule(DisallowShortOpenTagSniff::class);
    $ecsConfig->rule(DisallowAlternativePHPTagsSniff::class);
    $ecsConfig->rule(LowerCaseConstantSniff::class);
    $ecsConfig->rule(LowerCaseKeywordSniff::class);
    $ecsConfig->rule(LowerCaseTypeSniff::class);
    $ecsConfig->rule(NoSilencedErrorsSniff::class);
    $ecsConfig->rule(DiscourageGotoSniff::class);
    $ecsConfig->rule(CallTimePassByReferenceSniff::class);
    $ecsConfig->rule(UpperCaseConstantNameSniff::class);
    $ecsConfig->rule(ConstructorNameSniff::class);
    $ecsConfig->rule(DisallowSpaceIndentSniff::class);
    $ecsConfig->rule(MultiLineConditionSniff::class);
    $ecsConfig->rule(IncludingFileSniff::class);
    $ecsConfig->rule(FunctionCallSignatureSniff::class);
    $ecsConfig->rule(MethodDeclarationSniff::class);
    $ecsConfig->rule(NamespaceDeclarationSniff::class);
    $ecsConfig->rule(UseDeclarationSniff::class);
    $ecsConfig->rule(ControlStructureSpacingSniff::class);
    $ecsConfig->ruleWithConfiguration(NestingLevelSniff::class, ['absoluteNestingLevel' => 4]);
    $ecsConfig->ruleWithConfiguration(
        ReferenceUsedNamesOnlySniff::class,
        [
            'allowFullyQualifiedGlobalConstants' => true,
            'allowFullyQualifiedGlobalFunctions' => true,
            'allowFullyQualifiedGlobalClasses' => true,
            'searchAnnotations' => true,
        ],
    );
    $ecsConfig->rule(MbStrFunctionsFixer::class);
    $ecsConfig->ruleWithConfiguration(
        FinalInternalClassFixer::class,
        [
            'consider_absent_docblock_as_internal_class' => true,
        ],
    );
    $ecsConfig->rule(BackedEnumTypeSpacingSniff::class);
    $ecsConfig->ruleWithConfiguration(
        PropertyDeclarationSniff::class,
        [
            'checkPromoted' => true,
            'enableMultipleSpacesBetweenModifiersCheck' => true,
        ],
    );

    return array_fill_keys($skip, null);
};
